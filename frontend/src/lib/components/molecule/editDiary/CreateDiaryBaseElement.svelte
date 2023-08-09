<script lang="ts">
	import { createForm } from 'felte';
	import { validator } from '@felte/validator-yup';
	import * as yup from 'yup';
	import { descriptive } from 'yup-locale-ja';
	import type { ArchiveDiaryType } from '$lib/types/Diary';
	import InputText from '$lib/components/atom/form/InputText.svelte';
	import InputTextarea from '$lib/components/atom/form/InputTextarea.svelte';
	import SaveDiaryButton from '$lib/components/atom/form/SaveDiaryButton.svelte';
	import { enhance } from '$app/forms';

	yup.setLocale(descriptive);

	const schema = yup.object({
		date: yup.string().required(),
		title: yup.string().max(50),
		content: yup.string().max(20000).required()
	});

	const { form, errors } = createForm<yup.InferType<typeof schema>>({
		extend: validator({ schema })
	});
	export let diary: ArchiveDiaryType | null = null;
	export let method: 'POST' | 'PUTCH';
	export let action: string;
</script>

<form
	class="flex flex-col justify-center bg-black p-4 w-full h-full"
	{method}
	{action}
	use:enhance
	use:form
>
	<input type="hidden" name="id" value={diary?.id} />
	<InputText
		type="date"
		name="date"
		id="diary_date"
		value={diary?.date}
		errorMessages={$errors.date ?? []}
		className="border-2 border-b-0 rounded-2xl p-2 border-brown mx-auto bg-black"
	/>
	<InputText
		type="text"
		id="diary_title"
		placeholder="タイトル(50字以内)"
		name="title"
		autocomplete="off"
		value={diary?.title}
		errorMessages={$errors.title ?? []}
		className="border-2 border-b-0 rounded-2xl p-2 border-brown mx-auto w-2/3 bg-black"
	/>
	<InputTextarea
		placeholder="本文(20000字以内)"
		name="content"
		id="diary_content"
		errorMessages={$errors.content ?? []}
		value={diary?.content}
		className="border-2 border-b-0 rounded-2xl p-2 border-brown bg-black sm:p-4 diary-content-edit h-full"
	/>
	<SaveDiaryButton
		className="border-2 rounded-2xl p-2 border-brown bg-black hover:bg-brown hover:text-white duration-500"
	/>
</form>
