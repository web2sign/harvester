<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Generate Invoice</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<style>
  .py-5 {
    padding-top:5pt;
    padding-bottom:5pt;
  }
</style>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

<div class="wrapper py-5">
  <div class="container">
    <div class="py-5">
      <h1>Invoice Generator</h1>
      <p>Create Personal Token here: <a target="_blank" href="https://id.getharvest.com/developers">https://id.getharvest.com/developers</a></p>
      Once personal token is created, a harvest api and account id will be generated.
    </div>
    <form method="POST" action="{{ url('update') }}">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <p>
            <label for="harvest_token">Harvest Token</label>
            <input value="{{ $harvest_token ?? '' }}" name="harvest_token" id="harvest_token" type="text" class="form-control">
          </p>
          
        </div>
        <div class="col-md-6">
          <p>
            <label for="account_id">Account ID</label>
            <input value="{{ $account_id ?? '' }}" name="account_id" id="account_id" type="text" class="form-control">
          </p>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p>
            <label for="rate">Rate (Euro)</label>
            <input value="{{ $rate ?? '' }}" placeholder="15" name="rate" id="rate" step="0.1" type="number" class="form-control">
          </p>
          
        </div>
        <div class="col-md-6">
          <p>
            <label for="payment_method">Payment Method</label>
            <input value="{{ $payment_method ?? '' }}" placeholder="Wise" name="payment_method" id="payment_method" type="text" class="form-control">
          </p>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p>
            <label for="account_details">Account Details</label>
            <textarea name="account_details" id="account_details" rows="10" class="form-control" placeholder="Bank Name: BPI
Account Name: Roy Vincent Niepes
Account Number: 2679 1759 15">{{ $account_details ?? '' }}</textarea>
          </p>
        </div>
        <div class="col-md-6">
          <p>
            <label for="address">Recipient's Address</label>
            <textarea name="address" id="address" rows="10" class="form-control" placeholder="PH7A PKG9 BLK69 L8 Bagong Silang
1426 Caloocan City,
Philippines">{{ $address ?? '' }}</textarea>
          </p>
        </div>
      </div>
      <div style="margin-bottom:10px;">
        <label for="invoice_number">Invoice Number</label>
        <div class="row">
          <div class="col-md-4">
            <input value="{{ $invoice_prefix ?? '' }}" name="invoice_prefix" id="invoice_prefix" type="text" class="form-control" placeholder="RLN2">
          </div>
          <div class="col-md-8">
            <input value="{{ $invoice_number ?? '' }}" name="invoice_number" id="invoice_number" type="text" class="form-control" placeholder="{{ str_pad(date('m'), 4, 0, STR_PAD_LEFT) }}">
          </div>
        </div>
      </div>
      <p>
        <label for="invoice_details">Invoice Details</label>
        <textarea name="invoice_details" id="invoice_details" rows="10" class="form-control" placeholder="Roy Vincent Niepes
PH7A PKG9 BLK69 L8 Bagong Silang
1426 Caloocan City, Philippines
web2sign@gmail.com
TIN: 315-745-166">{{ $invoice_details ?? '' }}</textarea>
      </p>
      <button class="btn btn-primary" type="submit" value="update">Update Settings</button>
    </form>
    <hr>
    <form method="POST" action="{{ url('generate') }}">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <p>
            <label for="year">Year</label>
            <input name="year" id="year" type="text" class="form-control" placeholder="2023">
          </p>
        </div>
        <div class="col-md-6">
          <p>
            <label for="month">Select Month</label>
            <select class="form-control" name="month" id="month">
              @for($x=1;$x<=12;$x++)
              <option value="{{ Carbon\Carbon::parse(date("Y"). "-$x-01")->format('Y-m-d') }}">
                {{ Carbon\Carbon::parse(date("Y"). "-$x-01")->format('F') }}
              </option>
              @endfor
            </select>
          </p>
        </div>
      </div>
      <p>
        <label for="height">Page Height (Height of pdf page, adjust according to your needs)</label>
        <input placeholder="2300" type="number" class="form-control" value="">
      </p>
      <button class="btn btn-primary" type="submit" value="generate">Generate PDF</button>
    </form>
  </div>
</div>

</body>
</html>