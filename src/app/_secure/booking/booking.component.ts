import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { BookingService } from './../../_service/booking.service';

@Component({
  selector: 'app-booking',
  templateUrl: './booking.component.html',
  styleUrls: ['./booking.component.css']
})
export class BookingComponent implements OnInit {

  hideHttpServerError = false;

  bookingArr: any;

  constructor(
    private _router: Router,
    private _bookingService: BookingService,
  ) { }

  todayDate: any;
  tomDate: any;
  prevDate: any;
  
  ngOnInit() {

    this.getReferenceTime();

    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const previous = new Date();
    previous.setDate(previous.getDate() - 1);

    this.todayDate = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
    this.tomDate = tomorrow.getFullYear() + '/' + (tomorrow.getMonth() + 1) + '/' + tomorrow.getDate();
    this.prevDate = previous.getFullYear() + '/' + (previous.getMonth() + 1) + '/' + previous.getDate();


  }

  prevChangeDate(date) {
    const today = new Date(date);
    const tomorrow = new Date(date);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const previous = new Date(date);
    previous.setDate(previous.getDate() - 1);

    this.todayDate =  today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
    this.tomDate = tomorrow.getFullYear() + '/' + (tomorrow.getMonth() + 1) + '/' + tomorrow.getDate();
    this.prevDate = previous.getFullYear() + '/' + (previous.getMonth() + 1) + '/' + previous.getDate();
  }

  tomChangeDate(date) {
    const today = new Date(date);
    const tomorrow = new Date(date);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const previous = new Date(date);
    previous.setDate(previous.getDate() - 1); 

    this.todayDate = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
    this.tomDate = tomorrow.getFullYear() + '/' + (tomorrow.getMonth() + 1) + '/' + tomorrow.getDate();
    this.prevDate = previous.getFullYear() + '/' + (previous.getMonth() + 1) + '/' + previous.getDate();
  }

  getReferenceTime() {
    this._bookingService.getReferenceTime().subscribe(
      response => {

        if (response.success === true) {
          this.bookingArr = response.data;
          console.log(this.bookingArr);
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }  
      }
    );
  }

  addBook(book: any) {
    console.log(book);
  }

}
