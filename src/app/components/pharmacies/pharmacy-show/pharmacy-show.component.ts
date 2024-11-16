import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { PharmacyService } from '../../../services/pharmacy.service';
import { NgIf } from '@angular/common';

@Component({
  selector: 'app-pharmacy-show',
  templateUrl: './pharmacy-show.component.html',
  styleUrls: ['./pharmacy-show.component.css'],
  standalone: true,
  imports:[NgIf]
})
export class PharmacyShowComponent implements OnInit {
  pharmacyId: string | null = '';
  pharmacy: any = {};

  constructor(
    private pharmacyService: PharmacyService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.pharmacyId = this.route.snapshot.paramMap.get('id');

    if (this.pharmacyId) {
      this.pharmacyService.getPharmacyById(parseInt(this.pharmacyId)).subscribe({
        next: (response) => {
          this.pharmacy = response.data;
        },
        error: (error) => {
          console.error('Error fetching pharmacy:', error);
        }
      });
    }
  }
  goBack(): void {
    this.router.navigate(['/pharmacies']);
  }
}
