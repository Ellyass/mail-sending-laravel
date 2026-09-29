@if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

@if ($errors->any())
    <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('sendpost') }}" method="post" enctype="multipart/form-data">
    @csrf

    <p>
        <label>Kime</label><br>
        <input type="email" name="to" value="{{ old('to') }}" style="width: 400px">
    </p>

    <p>
        <label>Alıcı Adı (isteğe bağlı)</label><br>
        <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" style="width: 400px">
    </p>

    <p>
        <label>CC (virgülle ayırın)</label><br>
        <input type="text" name="cc" value="{{ old('cc') }}" style="width: 400px">
    </p>

    <p>
        <label>BCC (virgülle ayırın)</label><br>
        <input type="text" name="bcc" value="{{ old('bcc') }}" style="width: 400px">
    </p>

    <p>
        <label>Konu</label><br>
        <input type="text" name="subject" value="{{ old('subject') }}" style="width: 400px">
    </p>

    <p>
        <label>Mesaj</label><br>
        <textarea name="message" rows="10" style="width: 400px">{{ old('message') }}</textarea>
    </p>

    <p>
        <label>Ek Dosya (en fazla 5 MB)</label><br>
        <input type="file" name="file">
    </p>

    <input type="submit" value="Mail Gönder">
</form>
