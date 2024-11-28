<?php

namespace App\Livewire\Forms;

use App\Services\CalendarService;
use Http;
use Livewire\Component;

class CreateIntentionForm extends Component
{
    public $mass_date;
    public $contents = [];
    public $content = "";
    public $isLoading = false;
    public $showCalendar = false;

    public $currentYear;
    public $currentMonth;
    public $selectedDate;

    protected $calendarService;

    // public function __construct() {
    //     $this->calendarService = new CalendarService();
    // }

    // public function toggleCalendar()
    // {
    //     $this->showCalendar = !$this->showCalendar;
    // }

    // public function selectDate($day)
    // {
    //     $this->calendarService->pickDate($day);
    //     $this->mass_date = $this->calendarService->selectedDate;
    //     $this->showCalendar = false;
    // }

    // public function addMonth() {
    //     $this->calendarService->nextMonth();
    //     $this->currentMonth = $this->calendarService->currentMonth;
    //     $this->currentYear = $this->calendarService->currentYear;
    // }

    // public function backMonth()
    // {
    //     $this->calendarService->prevMonth();
    //     $this->currentMonth = $this->calendarService->currentMonth;
    //     $this->currentYear = $this->calendarService->currentYear;
    // }

    public function validateData() {
        $validated = $this->validate([
            'mass_date' => 'required|date',
            'contents' => 'required|array'
        ]);

        return $validated;
    }

    public function addIntentions() {
        $this->contents[] = $this->content;
        $this->content = "";
    }

    public function registerIntentions() {
        $this->isLoading = true;

        $data = $this->validateData();
    }

    public function render()
    {
        // $days = $this->calendarService->getDaysInMonth();
        return view('livewire.forms.create-intention-form');
    }

    // public function mount() {
    //     $this->currentMonth = $this->calendarService->currentMonth;
    //     $this->currentYear = $this->calendarService->currentYear;
    //     $this->selectedDate = $this->calendarService->selectedDate;
    // }
}
