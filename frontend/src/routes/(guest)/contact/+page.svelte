<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
</script>

<GuestHead title="お問い合わせ" description="かどで日記へのお問い合わせ" />
<PageHeading title="お問い合わせ" />
<div class="document-center">
	<div class="mb-12">
		<div class="flex items-center">
			<div class="w-2 h-8 bg-kn_3" />
			<h2 class="ml-2 text-2xl">作者</h2>
		</div>
		<div class="py-4">
			<p class="my-2">
				Twitter : <br class="md:hidden" /><a
					target="_blank"
					rel="norefferrer"
					href="https://twitter.com/usuyuki26">https://twitter.com/usuyuki26</a
				>
			</p>
			<p class="my-2">
				Misskey : <br class="md:hidden" /><a
					target="_blank"
					rel="norefferrer"
					href="https://m5y.usuyuki.net">https://m5y.usuyuki.net</a
				>
			</p>
		</div>
	</div>
	<div class="mb-12">
		<div class="flex items-center">
			<div class="w-2 h-8 bg-kn_3" />
			<h2 class="ml-2 text-2xl">かどで日記GitHubリポジトリ</h2>
		</div>
		<div class="py-4">
			<p class="my-2">
				GitHub : <br class="md:hidden" /><a
					target="_blank"
					rel="norefferrer"
					href="https://github.com/kadodeProject/kadode_nikki3"
					>https://github.com/kadodeProject/kadode_nikki3</a
				>
			</p>
		</div>
	</div>
	<div class="mb-12">
		<div class="flex items-center">
			<div class="w-2 h-8 bg-kn_3" />
			<h2 class="ml-2 text-2xl">お問い合わせフォーム</h2>
		</div>
		<div class="py-4">
			<p class="mb-2">下記Googleフォームよりご記入ください。</p>
			<p>
				<a target="_blank" rel="norefferrer" href="https://forms.gle/PXPynwdAZjP5d3pA6"
					>https://forms.gle/PXPynwdAZjP5d3pA6</a
				>
			</p>
		</div>
	</div>
</div>
