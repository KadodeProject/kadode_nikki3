<form class="flex justify-center flex-wrap flex-col" method="POST">
	<input type="hidden" name="_token" value="yj1L8xPIMzqRvvO3aK5lU5GpoCBpcO49GZq7XApd" />
	<input type="date" class="text-xl mx-auto mb-4 kiwi-maru" name="date" value="2023-04-16" />

	<input type="hidden" value="" name="id" />
	<input
		placeholder="タイトル(50字以内)"
		style="height:32px"
		class="mx-auto w-2/3"
		name="title"
		autocomplete="off"
		value=""
	/>

	<textarea
		placeholder="本文(20000字以内)"
		class="sm:p-4 w-full diary-content-edit"
		name="content"
		autocomplete="off"
		id="diary-content"
	/>
	<button type="submit" style="height:2em" class="kiwi-maru submitDiaryButton" id="submitDiary">
		日記を書き込む
	</button>
</form>
