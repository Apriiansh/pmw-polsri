#!/bin/bash

# ─────────────────────────────────────────────────────────────────────────────
#  Dev Script — CI4 + Tailwind CSS (v4)
#  Optimized for Robust Process Management & Clean Exit
# ─────────────────────────────────────────────────────────────────────────────

# --- Configuration ---
PORT=${1:-8080}
CSS_INPUT="./app/Views/css/input.css"
CSS_OUTPUT="./public/assets/css/app.css"
CSS_INPUT_V2="./app/Views/css/input-v2.css"
CSS_OUTPUT_V2="./public/assets/css/app-v2.css"
CSS_DIR="./public/assets/css"

# --- Colors ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BLUE='\033[0;34m'
RESET='\033[0m'

# --- Utility Functions ---

print_header() {
    echo -e "${CYAN}"
    echo "╔══════════════════════════════════════════════╗"
    echo "║          CI4 + TAILWIND DEV SERVER           ║"
    echo "╚══════════════════════════════════════════════╝"
    echo -e "${RESET}"
}

log() {
    echo -e "${CYAN}[$(date +'%H:%M:%S')]${RESET} $1"
}

error() {
    echo -e "${RED}[ERROR] $1${RESET}"
    exit 1
}

success() {
    echo -e "${GREEN}✓ $1${RESET}"
}

warn() {
    echo -e "${YELLOW}⚠ $1${RESET}"
}

# ─── Robust Cleanup Logic ───
CLEANING=0
cleanup() {
    if [ $CLEANING -eq 1 ]; then return; fi
    CLEANING=1
    
    echo -e "\n\n${YELLOW}⏹  Stopping development environment...${RESET}"
    
    # Send TERM to the entire process group
    # Using -$$ sends the signal to every process in the process group of the script
    kill -TERM -$$ 2>/dev/null
    
    # Give them a moment to shut down gracefully
    sleep 1
    
    # Hard kill any survivors in this process group (except ourselves)
    # This ensures ports are closed and watchers stopped
    kill -KILL -$$ 2>/dev/null
    
    log "Cleaning up ports..."
    local pids=$(lsof -ti tcp:$PORT 2>/dev/null)
    if [ -n "$pids" ]; then
        echo "$pids" | xargs kill -9 2>/dev/null
    fi
    
    success "All processes stopped. Port $PORT released."
    exit 0
}

# Trap signals for clean exit
trap cleanup INT TERM EXIT

# --- Main Logic ---

print_header

# 1. Port Management
log "Preparing port $PORT..."
kill_port_if_exists() {
    local pids=$(lsof -ti tcp:$PORT 2>/dev/null)
    if [ -n "$pids" ]; then
        warn "Port $PORT is occupied. Cleaning up..."
        echo "$pids" | xargs kill -9 2>/dev/null
        sleep 0.5
    fi
    success "Port $PORT is ready."
}
kill_port_if_exists

# 2. Dependency & Environment Checks
log "Checking environment..."

# Check .env file
if [ ! -f ".env" ] && [ ! -f "env" ]; then
    warn "No .env or env file found. CodeIgniter might use default settings."
fi

# Check PHP
if ! command -v php &> /dev/null; then
    error "PHP is not installed or not in PATH."
fi
success "PHP $(php -r 'echo PHP_VERSION;') found."

# Check Node/NPX
if ! command -v npx &> /dev/null; then
    error "Node.js (npx) is not installed. Required for Tailwind."
fi
success "Node $(node -v) found."

# Check CSS Input
if [ ! -f "$CSS_INPUT" ]; then
    error "Tailwind input file not found: $CSS_INPUT"
fi
mkdir -p "$CSS_DIR"
success "Directories and dependencies verified."

# 3. Initial Build
log "Performing initial CSS builds..."
npx @tailwindcss/cli -i "$CSS_INPUT" -o "$CSS_OUTPUT" 2>/dev/null
npx @tailwindcss/cli -i "$CSS_INPUT_V2" -o "$CSS_OUTPUT_V2" 2>/dev/null
if [ $? -eq 0 ]; then
    success "Initial CSS builds successful (v1 & v2)."
else
    warn "Initial CSS build had warnings/errors. Check your CSS files."
fi

# 4. Start Services
echo -e "\n${BLUE}🚀 Starting Services...${RESET}"
log "Server: http://localhost:${PORT}"
echo -e "${YELLOW}Press Ctrl+C to stop everything.${RESET}\n"

# Run Vite Dev Server (Handles both JS & CSS with HMR)
npm run dev 2>&1 | \
    sed "s/^/${BLUE}[vite]    ${RESET} /" &

TAILWIND_PID=$!

# Run PHP Spark Serve
# Use --quiet to reduce noise if preferred, or keep it for debugging
php spark serve --port=$PORT 2>&1 | \
    sed "s/^/${GREEN}[spark]   ${RESET} /" &
SPARK_PID=$!

# Wait for subprocesses
# We use a loop to keep the script alive and handle the trap correctly
while true; do
    sleep 1
    # Check if a process died unexpectedly
    if ! kill -0 $TAILWIND_PID 2>/dev/null; then
        warn "Tailwind watcher died. Restarting or exiting..."
        exit 1
    fi
    if ! kill -0 $SPARK_PID 2>/dev/null; then
        warn "PHP Spark server died."
        exit 1
    fi
done