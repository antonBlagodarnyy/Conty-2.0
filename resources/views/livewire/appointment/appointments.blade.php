<div class="flex flex-col items-center justify-center ">
  <div class="container">
    <livewire:navbar></livewire:navbar>
  </div>

  <flux:modal name="add-appointment" variant="flyout" position="left">
    <livewire:appointment.add.add-appointment></livewire:appointment.add.add-appointment>
  </flux:modal>

  <!--TODO reset values of the modal on close-->
  <flux:modal name="edit-appointment" variant="flyout" position="left">
    <livewire:appointment.edit.edit-appointment :$editedAppointmentId></livewire:appointment.edit.edit-appointment>
  </flux:modal>

  <div class="container">
    <livewire:appointment.appointment-table></livewire:appointment.appointment-table>
  </div>
</div>