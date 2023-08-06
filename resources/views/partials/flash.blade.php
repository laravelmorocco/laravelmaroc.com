@if ($message = Session::get('success'))
<div class="alert bg-green-500 border-t-4 border-green-300 rounded-b text-white font-bold px-4 py-3 shadow-md my-3">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert bg-red-500 border-t-4 border-red-300 rounded-b text-white font-bold px-4 py-3 shadow-md my-3">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert bg-yellow-500 border-t-4 border-yellow-300 rounded-b text-white font-bold px-4 py-3 shadow-md my-3">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert bg-blue-400 border-t-4 border-blue-300 rounded-b text-white font-bold px-4 py-3 shadow-md my-3">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert bg-red-500 border-t-4 border-red-300 rounded-b text-white font-bold px-4 py-3 shadow-md my-3">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Check the following errors :(
</div>
@endif

