import {Component, OnInit} from '@angular/core';
import {AuthService} from "../login/auth.service";
import {ToastrService} from "ngx-toastr";
import {Router} from "@angular/router";

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
})
export class LogoutComponent implements OnInit {

  constructor(
    private authService: AuthService,
    private toastr: ToastrService,
    private router: Router,
  ) {
  }

  ngOnInit() {
    this.logout()
  }

  logout(): void {
    window.sessionStorage.removeItem("token");
    window.sessionStorage.removeItem("userName");
    this.toastr.success('Usuário desconectado');
    this.router.navigate(['/login']);
  }
}
