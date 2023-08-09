<script lang="ts">
	import CreateDiaryBaseElement from '../../molecule/editDiary/CreateDiaryBaseElement.svelte';
	import type { ArchiveDiaryType } from '$lib/types/Diary';
	import { enhance } from '$app/forms';
	export let diary: ArchiveDiaryType | null = null;
</script>

<CreateDiaryBaseElement {diary} method="POST" action="?/update" />
<form
	method="POST"
	action="?/delete"
	use:enhance
	class="text-white bg-brown hover:underline p-2 rounded-full"
>
	<button type="submit">削除</button>
</form>
