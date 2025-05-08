<?php

namespace App\Livewire;

use Livewire\Component;

class Presentation extends Component
{
    public int $currentSlide = 0;
    
    public array $slides = [
        'welcome',
        'intro',
        'early-days',
        'work-experience',
        'discovery',
        'first-web-project',
        'php3',
        'first-frameworks',
        'laravel-enters',
        'laracasts',
        'today',
        'laravel-today',
        'future',
        'final-words'
    ];

    public function next(): void
    {
        if ($this->currentSlide < count($this->slides) - 1) {
            $this->currentSlide++;
        }
    }

    public function previous(): void
    {
        if ($this->currentSlide > 0) {
            $this->currentSlide--;
        }
    }

    public function render()
    {
        return view('livewire.presentation.index')
            ->layout('components.layouts.presentation', ['title' => 'Laravel Serbia Meetup']);
    }
}
