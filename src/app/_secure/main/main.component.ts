import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  moduleId: module.id,
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  
  userDetails: any;

  constructor(
    private _router: Router
  ) { }

  ngOnInit() {
    this.userDetails = JSON.parse(localStorage.getItem('user_details'));

  }



}
