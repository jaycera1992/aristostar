import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class CompanyService {

  private _url: string = AppSettings.API_ENDPOINT + 'secure';

  constructor(private _http: Http) { }

  getCompany(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/company/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }

  addCompany(data: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.post(this._url + '/' + localStorage.getItem('user_id') + '/company/add', params, { headers: headers })
      .map((response: Response) => response.json());
  }

  updateCompany(data: any, updateId: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.put(this._url + '/' + localStorage.getItem('user_id') + '/company/' + updateId, params, { headers: headers })
      .map((response: Response) => response.json());
  }

  deleteCompany(id: number) {
    const headers = new Headers();
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.delete(this._url + '/' + localStorage.getItem('user_id') + '/company/' + id, { headers: headers })
      .map((response: Response) => response.json());
  }

  getTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/company/total/total', { headers: headers })
      .map((response: Response) => response.json());
  }

  getDeletedTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/company/total/deleted', { headers: headers })
      .map((response: Response) => response.json());
  }

  getActiveTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/company/total/active', { headers: headers })
      .map((response: Response) => response.json());
  }
}
