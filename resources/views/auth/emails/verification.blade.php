<b>Hi!!</b><br>
Klik link dibawah ini untuk verifikasi akun larapusmu
<br>
<a href="{{ $link = url('auth/verify', $token).'?email='.urlencode($user->email) }}"> {{ $link }} </a>