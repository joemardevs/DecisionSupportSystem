<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Models\Research;
use Livewire\Component;

class View extends Component
{
    public $research;
    public function deleteResearch($id)
    {
        $research = Research::find($id);
        $research->delete();
        $this->render();
        return to_route('research')
            ->with('error', 'Deleted');
    }
    public $researchSuccessRate, $researchFailRate;
    public function mount($id)
    {
        $research = Research::find($id);
        $this->research = $research;

        $researchAuthors = $research->authors()->get();
        foreach ($researchAuthors as $author) {
            $authorAllResearch = $author->research()->count();
            $authorAboveCompletedResearch = $author->research()->where('status_id', '>=', 2)->count();

            $this->researchSuccessRate = ($authorAboveCompletedResearch / $authorAllResearch) * 100;
            $this->researchFailRate = 100 - $this->researchSuccessRate;
        }
    }
    public function render()
    {
        $titlePage = 'Research';
        return view('livewire.pages.admin.research.view', [
            'titlePage' => $titlePage,
            'researchSuccessRate' => $this->researchSuccessRate,
            'researchFailRate' => $this->researchFailRate,
        ])->layout('livewire.layouts.app');
    }
}
