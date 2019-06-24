<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    </head>
    <body>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <h2>Financial test form</h2>
          <form action="send" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="email">Phone Number *</label>
              <input type="text" class="form-control"  id="phone_number" placeholder="Enter phone number" name="phone_number">
            </div>
            <div class="form-group">
              <label for="email">Random Code *</label>
              <input type="text" class="form-control"  id="random_code" placeholder="Enter random code" name="random_code">
            </div>
            <div class="form-group">
              <label for="pwd">Text Message *</label>
              <textarea class="form-control"  name="text" id="text"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                    $.validator.addMethod('phoneUS', function(value, element) {
                    return value.match(/^\+(?:[0-9] ?){6,20}[0-9]$/);
                    },'Enter Valid  phone number');
                $("form").validate({
                  submitHandler: function(form) {
                    form.submit();
                  },
                rules: {
                    phone_number: {
                        minlength: 5,
                        phoneUS: true,
                        required: true
                    },
                    random_code: {
                        required: true,
                        number: true
                    },
                    text: {
                        minlength: 5,
                        required: true
                    }
                },
                highlight: function (element) {
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function (element) {
                    element.text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
    }
                 });
            })
        </script>
    </body>
</html>
