<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PmwPeriodModel;
use App\Models\Expo\PmwAwardCategoryModel;
use App\Models\Expo\PmwAwardModel;
use App\Models\Proposal\PmwProposalModel;
use App\Services\PmwExpoService;
use CodeIgniter\HTTP\ResponseInterface;

class AwardController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $expoService;
    protected $periodModel;

    public function __construct()
    {
        $this->expoService = new PmwExpoService();
        $this->periodModel = new PmwPeriodModel();
    }

    /**
     * Award Management Page
     */
    public function index(): string
    {
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        
        $categoryModel = new PmwAwardCategoryModel();
        $awardModel = new PmwAwardModel();
        $proposalModel = new PmwProposalModel();

        $categories = $categoryModel->getCategoriesByPeriod((int)$activePeriod['id']);
        
        // Get only teams that passed finalization
        $db = \Config\Database::connect();
        $teams = $db->table('pmw_proposals p')
                    ->select('p.id, p.nama_usaha, pm.nama as ketua_nama')
                    ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                    ->join('pmw_selection_finalization psf', 'psf.proposal_id = p.id')
                    ->where('psf.admin_status', 'approved')
                    ->where('p.period_id', $activePeriod['id'])
                    ->get()->getResultArray();

        foreach ($categories as &$cat) {
            $cat->winners = $awardModel->getWinnersByCategory((int)$cat->id);
        }

        return view('admin/expo/awards', [
            'title'      => 'Manajemen Pemenang Award | PMW Polsri',
            'categories' => $categories,
            'teams'      => $teams,
        ]);
    }

    /**
     * Assign Winner
     */
    public function assignWinner(): ResponseInterface
    {
        try {
            $data = $this->request->getPost();
            $this->expoService->assignWinner($data);
            
            return redirect()->back()->with('success', 'Pemenang award berhasil ditetapkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Winner
     */
    public function deleteWinner(int $id): ResponseInterface
    {
        try {
            $this->expoService->deleteWinner($id);
            return redirect()->back()->with('success', 'Penetapan pemenang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
