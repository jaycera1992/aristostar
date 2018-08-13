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

  usersNav = false;
  companyNav = false;
  employeeNav = false;

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
    
    if (urlLink[5] == 'users') {
      this.titleHeader = 'User Management';
      this.usersNav = true;
    } else if (urlLink[5] == 'company') {
      this.titleHeader = 'Company Management';
      this.companyNav = true;
    }  else if (urlLink[5] == 'employee') {
      this.titleHeader = 'Employee Management';
      this.employeeNav = true;
    }

    this.userDetails = JSON.parse(localStorage.getItem('user_details'));
  }

  logout(event: any) {

    localStorage.removeItem('user_details');
    localStorage.removeItem('user_id');
    localStorage.removeItem('token');

    this._router.navigate(['/login']);
  }

  changeNav(nav: any) {
    if (nav == 'users') {
      this.usersNav = true;
      this.companyNav = false;
      this.employeeNav = false;
      this.titleHeader = 'User Management';
    } else if (nav == 'company') {
      this.usersNav = false;
      this.companyNav = true;
      this.employeeNav = false;
      this.titleHeader = 'Company Management';
    } else if (nav == 'employee') {
      this.usersNav = false;
      this.companyNav = false;
      this.employeeNav = true;
      this.titleHeader = 'Employee Management';
    }
  }
}
