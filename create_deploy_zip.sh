#!/bin/bash

#--------------------------------------------------------------------
# Script untuk membuat file ZIP deployment ke cPanel
# Project: PMW Polsri
# Target: simpmw.polsri.ac.id (opsimpmw)
#--------------------------------------------------------------------

echo "========================================"
echo "Deployment ZIP Generator - PMW Polsri"
echo "========================================"
echo ""

# Set variables
PROJECT_DIR="$(cd "$(dirname "$0")" && pwd)"
DEPLOY_DIR="$PROJECT_DIR/deploy"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

# Output files
ZIP_APP="$PROJECT_DIR/deploy_pmw-app.zip"
ZIP_PUBLIC="$PROJECT_DIR/deploy_public_html.zip"

# Remove old zip files if exist
rm -f "$ZIP_APP" "$ZIP_PUBLIC"

# 0. Jalankan Build Vite
echo "🔷 Menjalankan build assets (Vite)..."
# Hapus cache vite jika ada
rm -rf node_modules/.vite 2>/dev/null || true
npm run build

echo "📁 Project Directory: $PROJECT_DIR"
echo "📦 Creating deployment packages..."
echo ""

#--------------------------------------------------------------------
# 1. Create pmw-app.zip (untuk upload ke home directory)
#--------------------------------------------------------------------
echo "🔷 Creating pmw-app.zip..."

# Create temp directory for app files
TEMP_APP="$PROJECT_DIR/temp_pmw-app"
rm -rf "$TEMP_APP"
mkdir -p "$TEMP_APP/pmw-app"

# Copy application files
echo "   Copying framework folders (app, vendor, writable)..."
cp -r app "$TEMP_APP/pmw-app/"
cp -r vendor "$TEMP_APP/pmw-app/"
cp -r writable "$TEMP_APP/pmw-app/"

echo "   Copying other necessary files..."
cp composer.json "$TEMP_APP/pmw-app/" 2>/dev/null || true
cp preload.php "$TEMP_APP/pmw-app/" 2>/dev/null || true
cp spark "$TEMP_APP/pmw-app/" 2>/dev/null || true

# Copy modified Config files for deployment
cp "$DEPLOY_DIR/pmw-app/app/Config/Paths.php" "$TEMP_APP/pmw-app/app/Config/Paths.php"
cp "$DEPLOY_DIR/pmw-app/.htaccess" "$TEMP_APP/pmw-app/.htaccess"

# Copy .env dari folder deploy (Produksi)
if [ -f "$DEPLOY_DIR/pmw-app/.env" ]; then
    echo "   Using production .env from deploy folder..."
    cp "$DEPLOY_DIR/pmw-app/.env" "$TEMP_APP/pmw-app/.env"
else
    echo "   ⚠️ WARNING: deploy/pmw-app/.env not found. Copying local .env..."
    cp "$PROJECT_DIR/.env" "$TEMP_APP/pmw-app/.env"
fi

# Clean writable folders
rm -rf "$TEMP_APP/pmw-app/writable/cache/"* 2>/dev/null || true
rm -rf "$TEMP_APP/pmw-app/writable/debugbar/"* 2>/dev/null || true
rm -rf "$TEMP_APP/pmw-app/writable/logs/"* 2>/dev/null || true
rm -rf "$TEMP_APP/pmw-app/writable/session/"* 2>/dev/null || true

# Maintain directory structure
touch "$TEMP_APP/pmw-app/writable/cache/.gitkeep"
touch "$TEMP_APP/pmw-app/writable/debugbar/.gitkeep"
touch "$TEMP_APP/pmw-app/writable/logs/.gitkeep"
touch "$TEMP_APP/pmw-app/writable/session/.gitkeep"
touch "$TEMP_APP/pmw-app/writable/uploads/.gitkeep"

# Create zip
cd "$TEMP_APP"
zip -rq "$ZIP_APP" pmw-app

# Cleanup
rm -rf "$TEMP_APP"

echo "   ✅ Created: deploy_pmw-app.zip"
echo ""

#--------------------------------------------------------------------
# 2. Create public_html.zip (untuk upload ke public_html)
#--------------------------------------------------------------------
echo "🔷 Creating public_html.zip..."

cd "$PROJECT_DIR"

# Create temp directory for public files
TEMP_PUBLIC="$PROJECT_DIR/temp_public_html"
rm -rf "$TEMP_PUBLIC"
mkdir -p "$TEMP_PUBLIC"

# Copy public folder contents (termasuk hasil build vite)
echo "   Copying public folder contents..."
cp -r public/* "$TEMP_PUBLIC/" 2>/dev/null || true
cp public/.htaccess "$TEMP_PUBLIC/" 2>/dev/null || true

# Overwrite with modified index.php for deployment
cp "$DEPLOY_DIR/public_html/index.php" "$TEMP_PUBLIC/index.php"

# Create zip
cd "$TEMP_PUBLIC"
zip -rq "$ZIP_PUBLIC" .

# Cleanup
rm -rf "$TEMP_PUBLIC"

echo "   ✅ Created: deploy_public_html.zip"
echo ""

#--------------------------------------------------------------------
# Summary
#--------------------------------------------------------------------
echo "========================================"
echo "✅ Deployment packages created!"
echo "========================================"
echo ""
echo "📦 Panduan Upload untuk opsimpmw:"
echo ""
echo "   1. deploy_pmw-app.zip"
echo "      → Upload & Extract ke: /home/opsimpmw/"
echo "      ✅ File .env produksi sudah otomatis disertakan."
echo ""
echo "   2. deploy_public_html.zip"
echo "      → Upload & Extract ke: /home/opsimpmw/public_html/"
echo "      ✅ Folder build/ (Vite) sudah otomatis disertakan."
echo ""
echo "📝 Ukuran File:"
ls -lh "$ZIP_APP" "$ZIP_PUBLIC" 2>/dev/null | awk '{print "   " $9 ": " $5}'
echo ""
echo "📖 Baca DEPLOY.md untuk troubleshooting!"
echo "========================================"

