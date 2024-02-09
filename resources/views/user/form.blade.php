<div class="form-group text-danger mb-2">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
<form method="post" action="{{ $action }}">
    @csrf
    @method($method)
    <div class="form-group mb-2">
        <label for="name">Meno a priezvisko<span style="font-variant: all-petite-caps">*</span></label>
        <input type="text" class="´form-control" id="name" name="name" placeholder="Full name" value="{{ old('name', @$model->name) }}" required>
    </div>
    <div class="form-group mb-2">
        <label for="email">Email<span style="font-variant: all-petite-caps">*</span></label>
        <input type="email" class="´form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"
               value="{{ old('email', @$model->email) }}" required>
        <small id="emailHelp" class="form-text text-muted">Nikdy nebudeme zdieľať vašu emailovú adresu.</small>
    </div>
    <div class="form-group mb-2">
        <label for="password">Heslo<span style="font-variant: all-petite-caps">*</span></label>
        <input type="password" class="´form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group mb-2">
        <label for="password">Heslo znova<span style="font-variant: all-petite-caps">*</span></label>
        <input type="password" class="´form-control" id="password" name="password_confirmation" placeholder="Password">
    </div>
    <input type="button" class="btn btn-warning" value="Zrušiť" onclick="history.back()">
    <input type="submit" class="btn btn-success" value="Poslať">
</form>
