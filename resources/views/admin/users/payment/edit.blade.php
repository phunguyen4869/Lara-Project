@extends('admin.main')

@section('content')
    @include('admin.alert')
    <form action="#" method="POST">
        <h4>User: {{$user->name}}</h4>

        <div class="input-group mb-3">
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="credit_card" @if ($user->payment_method == 'credit_card') selected @endif>Thẻ tín dụng</option>
                <option value="atm_card" @if ($user->payment_method == 'atm_card') selected @endif>Thẻ ATM nội địa</option>
                <option value="cod" @if ($user->payment_method == 'cod') selected @endif>Thanh toán khi nhận hàng</option>
            </select>
        </div>

        <div id="credit_card" @if ($user->payment_method != 'credit_card')
            class="hidden"
        @endif>
            <div class="input-group mb-3">
                <input type="text" name="credit_card_number" class="form-control" placeholder="Credit card number"
                    value="{{ $user->credit_card_number }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-credit-card"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="number" name="cvv_code" class="form-control" placeholder="CvV code"
                    value="{{ $user->cvv_code }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="date" name="expiration_date" class="form-control"
                    value="{{ $user->expiration_date }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-calendar-alt"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="credit_card_name" class="form-control" placeholder="Credit card name"
                    value="{{ $user->credit_card_name }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="atm_card" @if ($user->payment_method != 'atm_card')
            class="hidden"
        @endif>
            <div class="input-group mb-3">
                <input type="text" name="atm_card_number" class="form-control" placeholder="ATM card number"
                    value="{{ $user->atm_card_number }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-credit-card"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="bank_name" class="form-control" placeholder="Bank name"
                    value="{{ $user->bank_name }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-university"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="atm_card_name" class="form-control" placeholder="ATM card name"
                    value="{{ $user->atm_card_name }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa Payment Method</button>
        </div>
        @csrf
    </form>
@endsection
