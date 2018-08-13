import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  moduleId: module.id,
  selector: 'app-employee-list',
  templateUrl: './employee-list.component.html',
  styleUrls: ['./employee-list.component.css']
})
export class EmployeeListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() employeeArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalEmployee: number;

  constructor() { }

  ngOnInit() {
  }

  addEmployee() {
    this.showEditForm.emit({ 'trigger': 2 });
  }

}
