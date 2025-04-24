<div class="flex flex-col items-center justify-center ">
  <div class="container">
    <livewire:navbar></livewire:navbar>
  </div>

  <flux:modal name="add-appointment" variant="flyout" position="left">
    <livewire:appointment.add.add-appointment></livewire:appointment.add.add-appointment>
  </flux:modal>

  <div class="container">
    <livewire:appointment.appointment-table></livewire:appointment.appointment-table>
  </div>
</div>