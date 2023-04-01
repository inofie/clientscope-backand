@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-4">
        <div class="row pb-3">
            <div class="col-md-12">
                <h4 class="heading2 font-30">Account Details</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                @if( strtotime(date('Y-m-d')) > strtotime($user_package['expire_date']) )
                <div class="alert alert-danger">
                    Your subscription has been expired
                </div>
                @endif
                @include('admin.flash-message')
                <div class="table-responsive">
                    <table class=" account-table table table-bordered">
                        <tbody>
                            <tr>
                                <th>Product Name</th>
                                <td class="">
                                    {{ $user_package['subscription_package']['title'] }}
                                </td>
                                <td class="text-center">
                                    <button data-toggle="modal" data-target="#package_modal"
                                        class="btn btn-orange btn-theme">Upgrade</button>
                                </td>
                            </tr>
                            <tr>
                                <th>Subscription state</th>
                                <td class="">
                                    {{ strtotime(date('Y-m-d')) > strtotime($user_package['expire_date']) ? 'Expired' : 'Active' }}
                                </td>
                                <td class="text-center"><button class="btn btn-orange btn-theme">Contact customer
                                        service</button></td>
                            </tr>
                            <tr>
                                <th>Subscription Expiry Date</th>
                                <td class="">
                                    {{ $user_package['expire_date'] }}
                                </td>
                            </tr>
                            <tr>
                                <th>Next Charge (total does not include your current invited or trialling users)</th>
                                <td class="">
                                    ${{ round($total_users * $user_package['subscription_package']['month_per_user_amount'] ,2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="package_modal" class="modal fade" role="dialog">
    <form method="post" action="{{ route('admin.upgrade-package') }}" id="payment-form">
        {{ csrf_field() }}
        <input type="hidden" id="total_user" name="total_user" value="{{ $total_users }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="display:inline;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Subscription</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Subscription Package <a target="_blank"
                                href="http://ec2-13-58-65-214.us-east-2.compute.amazonaws.com#clientscopepricing">( View
                                Package Detail )</a></label>
                        <select required name="subscription_package_id" class="form-control">
                            <option value=""> -- Select Package -- </option>
                            @if( count($subscriptionPackages) )
                            @foreach( $subscriptionPackages as $subscriptionPackage )
                            <option data-price="{{ $subscriptionPackage->month_per_user_amount }}"
                                value="{{ $subscriptionPackage->id }}">{{ $subscriptionPackage->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Charge Amount</label>
                        <input type="text" readonly name="charge_amount" class="form-control" value="0">
                    </div>
                    <div class="form-group">
                        <label for="card-element">Credit or debit card</label>
                        <div id="card-element"></div>
                        <div style="color:red;" id="card-errors" role="alert"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-orange">Submit</button>
                </div>
            </div>
        </div>
</div>
</form>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
$('select[name="subscription_package_id"]').change(function() {
    let price = $('option:selected', this).attr('data-price');
    let total_user = $('#total_user').val();
    $('input[name="charge_amount"]').val((parseFloat(price) * parseInt(total_user)));
})


var stripe = Stripe('{{ env("STRIPE_PUBLISHED_KEY") }}');
var elements = stripe.elements();
// Create an instance of the card Element.
var card = elements.create('card');
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    $('#overlay').show();
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
@endsection