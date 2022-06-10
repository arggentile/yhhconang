import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DivisionEscoclarComponent } from './division-escoclar.component';

describe('DivisionEscoclarComponent', () => {
  let component: DivisionEscoclarComponent;
  let fixture: ComponentFixture<DivisionEscoclarComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DivisionEscoclarComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DivisionEscoclarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
