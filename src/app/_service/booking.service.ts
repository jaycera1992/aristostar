import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class BookingService {

  private _url: string = AppSettings.API_ENDPOINT + 'open/reference';

  constructor(private _http: Http) { }

  getReferenceTime() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/time', { headers: headers })
      .map((response: Response) => response.json());
  }

}
