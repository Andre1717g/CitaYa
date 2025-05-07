@extends('layouts.app')

@section('title', 'Formulario de Pago')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-success bg-opacity-10 py-3 border-0">
                    <h2 class="text-center fw-bold text-success mb-0">
                        <i class="fas fa-credit-card me-2"></i>Formulario de Pago
                    </h2>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('doctor.store-pago') }}">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Número de Tarjeta -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('card_number') is-invalid @enderror" 
                                           id="card_number" name="card_number" placeholder="Número de tarjeta" required>
                                    <label for="card_number">Número de Tarjeta</label>
                                    @error('card_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha de Expiración -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="month" class="form-control @error('expiration_date') is-invalid @enderror" 
                                           id="expiration_date" name="expiration_date" required>
                                    <label for="expiration_date">Fecha de Expiración</label>
                                    @error('expiration_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- CVV -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('cvv') is-invalid @enderror" 
                                           id="cvv" name="cvv" placeholder="CVV" required>
                                    <label for="cvv">CVV</label>
                                    @error('cvv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botón de Pago -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill">
                                    Realizar Pago <i class="fas fa-credit-card ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
