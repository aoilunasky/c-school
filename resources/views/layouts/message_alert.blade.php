@if (session()->has('success'))
<success-alert-component :msg="'{{session()->get('success')}}'" :type="'alert-success'"></success-alert-component>
@endif

@if (session()->has('error'))
<success-alert-component :msg="'{{session()->get('error')}}'" :type="'alert-danger'"></success-alert-component>
@endif
