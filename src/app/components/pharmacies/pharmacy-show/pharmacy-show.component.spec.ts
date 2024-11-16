import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PharmacyShowComponent } from './pharmacy-show.component';

describe('PharmacyShowComponent', () => {
  let component: PharmacyShowComponent;
  let fixture: ComponentFixture<PharmacyShowComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [PharmacyShowComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PharmacyShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
