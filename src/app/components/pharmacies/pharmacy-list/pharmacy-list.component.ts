import { Component, OnInit } from '@angular/core';
import { PharmacyService } from '../../../services/pharmacy.service';
import { Router } from '@angular/router';
import { NgFor } from '@angular/common';

@Component({
  selector: 'app-pharmacy-list',
  templateUrl: './pharmacy-list.component.html',
  styleUrls: ['./pharmacy-list.component.css'],
  standalone: true,
  imports: [NgFor]
})
export class PharmacyListComponent implements OnInit {
  pharmacies: any[] = [];
  currentPage: number = 1;
  totalPages: number = 1;

  constructor(
    private pharmacyService: PharmacyService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.loadPharmacies();
  }

  loadPharmacies(): void {
    this.pharmacyService.getPharmacies(this.currentPage).subscribe(response => {
      this.pharmacies = response.data.data;
      this.totalPages = response.data.last_page;
    });
  }

  onPageChange(page: number): void {
    this.currentPage = page;
    this.loadPharmacies();
  }

  viewDetails(id: number): void {
    this.router.navigate(['/pharmacies', id]);
  }

  editPharmacy(id: number): void {
    this.router.navigate(['/pharmacies/edit', id]);
  }

  deletePharmacy(id: number): void {
    if (confirm('Are you sure you want to delete this pharmacy?')) {
      this.pharmacyService.deletePharmacy(id).subscribe(() => {
        this.loadPharmacies();
      });
    }
  }

  addPharmacy(): void {
    this.router.navigate(['/pharmacies/create']);
  }
}
