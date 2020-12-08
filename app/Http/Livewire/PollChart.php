<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class PollChart extends Component
{
    public Poll $poll;

    public function mount(Poll $poll)
    {
        $this->poll = $poll;
    }

    public function render()
    {
        $pieChartModel = new PieChartModel;
        $pieChartModel->setTitle(sprintf('Poll %d Results', $this->poll->id));

        foreach ($this->poll->choices as $choice) {
           $pieChartModel->addSlice(
               $choice->text,
               $choice->votes,
               random_color()
           );
        }

        return view('livewire.poll-chart', compact('pieChartModel'));
    }

    private function colors($count) : array
    {

        return [];
    }

}
