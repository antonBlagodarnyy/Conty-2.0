<div class="flex flex-col items-center justify-center ">
  <div class="container">
    <livewire:navbar></livewire:navbar>
  </div>

  <flux:modal name="add-appointment" variant="flyout" position="left" @close="clearAddForm">
    <livewire:appointment.add.add-appointment></livewire:appointment.add.add-appointment>
  </flux:modal>


  <flux:modal name="edit-appointment" variant="flyout" position="left" @close="clearEditForm">
    <livewire:appointment.edit.edit-appointment :$editedAppointmentId></livewire:appointment.edit.edit-appointment>
  </flux:modal>

  <div class="container">
    <livewire:appointment.appointment-table></livewire:appointment.appointment-table>
  </div>
</div>