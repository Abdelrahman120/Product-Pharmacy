import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { NavbarComponent, } from './components/navbar/navbar.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, NavbarComponent, FormsModule,ReactiveFormsModule],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'products-clientSide';
}