@error('title')
<div class="text-red-700">{{ $message }}</div>
@enderror
<form class=" "method="POST" action="/diary/edit">
    @csrf
    <input class="" type="text" name="title" >
    <textarea class="" type="text" name="content" ></textarea>
    <select name="feel"size="1" >
        <option value="1">1(悪い)</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5" selected>5(ふつう)</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10(良い)</option>
    </select>
    <input type="submit" value="日記を書き込む">
    
</form>