import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { BookingComponent } from './../../_secure/booking/booking.component';

import { BookingService } from './../../_service/booking.service';

const routes: Routes = [
  { path: '', component: BookingComponent }
];


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    MaterialModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    BookingComponent
  ],
  exports: [
    BookingComponent
  ],
  providers: [
    BookingService
  ]
})
export class BookingModule { }
