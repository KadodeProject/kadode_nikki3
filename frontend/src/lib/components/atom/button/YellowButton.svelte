<script lang="ts">
	export let url: string;
	export let title: string;
</script>

<a
	href={url}
	class="py-2 px-4 text-black rounded-2xl border-2 border-black duration-300 hover:bg-black bg-kn-a-yellow hover:border-kn-a-yellow hover:text-kn-a-yellow"
>
	{title}
</a>
