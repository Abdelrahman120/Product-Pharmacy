import { Component } from '@angular/core';
import { Router, RouterLink, RouterLinkActive } from '@angular/router';
@Component({
  selector: 'app-landing',
  standalone: true,
  templateUrl: './landing.component.html',
  imports: [RouterLink, RouterLinkActive],
  styleUrl: './landing.component.css'
})
export class LandingComponent {

  constructor(
    private router: Router
  ) {}
}
