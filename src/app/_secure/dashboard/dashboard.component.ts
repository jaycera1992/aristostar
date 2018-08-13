import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { AppSettings } from './../../app.settings';

@Component({
  moduleId: module.id,
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  loadingEvent = true;
  userDetails : any;

  dashboardNav = false;
  usersNav = false;
  bookingNav = false;
  companyNav = false;

  titleHeader: any;

  urlLink = AppSettings.URL_WEBSITE;

  constructor(
    private _router: Router
  ) { }

  ngOnInit() {
    setTimeout(() => {
      this.loadingEvent = false;
    }, 3000);
    const urlLink = window.location.href.split( '/' );
    if(urlLink[5] == 'main') {
      this.titleHeader = 'Dashboard';
      this.dashboardNav = true;
    } else if (urlLink[5] == 'users') {
      this.titleHeader = 'User Management';
      this.usersNav = true;
    } else if (urlLink[5] == 'booking') {
      this.titleHeader = 'Booking';
      this.bookingNav = true;
    } else if (urlLink[5] == 'company') {
      this.titleHeader = 'Company Management';
      this.companyNav = true;
    }

    this.userDetails = JSON.parse(localStorage.getItem('user_details'));
  }

  logout(event: any) {
    
    this.titleHeader = 'Dashboard';
    localStorage.removeItem('user_details');
    localStorage.removeItem('user_id');
    localStorage.removeItem('token');

    this._router.navigate(['/login']);
  }

  changeNav(nav: any) {
    if(nav == 'dashboard') {
      this.dashboardNav = true;
      this.usersNav = false;
      this.bookingNav = false;
      this.companyNav = false;
      this.titleHeader = 'Dashboard';
    } else if (nav == 'users') {
      this.usersNav = true;
      this.bookingNav = false;
      this.dashboardNav = false;
      this.companyNav = false;
      this.titleHeader = 'User Management';
    } else if (nav == 'booking') {
      this.usersNav = false;
      this.dashboardNav = false;
      this.bookingNav = true;
      this.companyNav = false;
      this.titleHeader = 'Booking';
    } else if (nav == 'company') {
      this.usersNav = false;
      this.dashboardNav = false;
      this.bookingNav = false;
      this.companyNav = true;
      this.titleHeader = 'Company Management';
    }
  }
}
