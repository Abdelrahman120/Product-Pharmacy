import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { PharmacyService } from '../../../services/pharmacy.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-pharmacy-edit',
  templateUrl: './pharmacy-edit.component.html',
  styleUrls: ['./pharmacy-edit.component.css'],
  standalone: true,
  imports: [FormsModule]
})
export class PharmacyEditComponent implements OnInit {
  pharmacyId: string | null = '';
  name: string = '';
  address: string = '';

  constructor(
    private pharmacyService: PharmacyService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.pharmacyId = this.route.snapshot.paramMap.get('id');

    if (this.pharmacyId) {
      this.pharmacyService.getPharmacyById(parseInt(this.pharmacyId)).subscribe({
        next: (response) => {
          const pharmacy = response.data;
          this.name = pharmacy.name;
          this.address = pharmacy.address;
        },
        error: (error) => {
          console.error('Error fetching pharmacy:', error);
        }
      });
    }
  }

  updatePharmacy(): void {
    if (this.name && this.address) {
      const updatedPharmacy = {
        name: this.name,
        address: this.address
      };

      this.pharmacyService.updatePharmacy(parseInt(this.pharmacyId!), updatedPharmacy).subscribe({
        next: (response) => {
          console.log('Pharmacy updated successfully:', response);
          this.router.navigate(['/pharmacies']);
        },
        error: (error) => {
          console.error('Error updating pharmacy:', error);
        }
      });
    }
  }

  cancel(): void {
    this.router.navigate(['/pharmacies']);
  }
}
