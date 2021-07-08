<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jumia Phobebook</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="antialiased">
<div class="row justify-content-start">
    <div class="col">
        <h1>Phone numbers</h1>
    </div>
</div>

<form action="">
    <div class="row justify-content-start">
        <div class="col-4">
            <select id="country_select" name="country_select" class="form-select" aria-label="Select a country">
                <option value="-1" selected>Select a Country</option>
                @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <select id="state_select" name="state_select" class="form-select" aria-label="Select a validity">
                <option value="-1" selected>Select a validity state</option>
                <option value="1">OK</option>
                <option value="0">NOK</option>
            </select>
        </div>
    </div>
</form>
<div class="row justify-content-start">
    <div class="col">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Country</th>
                <th scope="col">State</th>
                <th scope="col">Country code</th>
                <th scope="col">Phone num.</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($phones as $phone)
                <tr>
                    <th scope="row">{{$phone->country->name}}</th>
                    <td>{{$phone->is_valid?'OK':'NOK'}}</td>
                    <td>+{{$phone->country->code}}</td>
                    <td>{{$phone->number}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        {{$phones->links()}}
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col">
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    (function (jQuery) {
        $(document).ready(function () {
            const appendQueryStringToUrl = function (paramName, paramValue) {
                let newUrl = window.location.href
                let junction = '?'
                if (window.location.href.indexOf('?') >= 0) {
                    junction = '&'
                }
                console.log(junction)
                if (window.location.href.indexOf(paramName + '=') < 0) {
                    newUrl += junction + paramName + '=' + paramValue
                } else {
                    newUrl = newUrl.replace(new RegExp(paramName + '=(\-)*[0-9]+', 'gi'), paramName + '=' + paramValue)
                }
                return newUrl
            }

            const resetPageParam = function (url) {
                return url.replace(/page=[0-9]+/, 'page=1')
            }

            const gotoURL = function (url) {
                window.location.href = url
            }

            const applyNewFilterValue = function (name, value) {
                console.log(value);
                let nextUrl = appendQueryStringToUrl(name, value)
                console.log(nextUrl);
                nextUrl = resetPageParam(nextUrl)
                console.log(nextUrl);
                gotoURL(nextUrl)
            }

            const disableAllInputs = function () {
                $('#state_select, #country_select').prop("disabled", true)
            }

            $('#state_select').val("{{$filterState??-1}}");
            $('#country_select').val("{{$filterCountry??-1}}");

            $('#state_select').on('change', function (e) {
                disableAllInputs()
                applyNewFilterValue('filterState', this.value)
            })
            $('#country_select').on('change', function (e) {
                disableAllInputs()
                applyNewFilterValue('filterCountry', this.value)
            })
        })
    })(jQuery);
</script>

</body>
</html>
