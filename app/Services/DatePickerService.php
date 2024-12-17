<?php
namespace App\Services;
use Carbon\Carbon;
class DatePickerService
{
  public $currentYear;
  public $currentMonth;
  public $selectedDate;
  public function __construct($currentYear = null, $currentMonth = null, $selectedDate = null)
  {
    $this->currentYear = $currentYear ?? Carbon::now()->year;
    $this->currentMonth = $currentMonth ?? Carbon::now()->month;
    $this->selectedDate = $selectedDate ?? null;
  }
  public function getDaysInMonth()
  {
    $daysInMonth = Carbon::create($this->currentYear, $this->currentMonth)->daysInMonth;
    $firstDayOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek;
    $days = [];
    $day = 1;
    for ($i = 0; $i < $firstDayOfMonth; $i++) {
      $days[] = null;
    }
    while ($day <= $daysInMonth) {
      $days[] = $day;
      $day++;
    }
    return $days;
  }
  public function pickDate(string $day)
  {
    if ($day) {
      $this->selectedDate = Carbon::create($this->currentYear, $this->currentMonth, $day)->format('d-m-Y');
    }
  }
  public function nextMonth()
  {
    if ($this->currentMonth == 12) {
      $this->currentMonth = 1;
      $this->currentYear++;
    } else {
      $this->currentMonth++;
    }
  }
  public function prevMonth()
  {
    if ($this->currentMonth == 1) {
      $this->currentMonth = 12;
      $this->currentYear--;
    } else {
      $this->currentMonth--;
    }
  }
}