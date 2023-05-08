<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
</script>

<GuestHead title="ログイン" description="ログインページ" />
<form method="post" action="?/login">
	<label class="block text-sm">
		<span class="text-gray-700 dark:text-gray-400">Email</span>
		<input
			name="email"
			type="email"
			class="block mt-1 w-full text-sm dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:border-purple-400 focus:outline-none form-input dark:focus:shadow-outline-gray focus:shadow-outline-purple"
			placeholder="Jane Doe"
		/>
	</label>
	<label class="block mt-4 text-sm">
		<span class="text-gray-700 dark:text-gray-400">Password</span>
		<input
			name="password"
			class="block mt-1 w-full text-sm dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:border-purple-400 focus:outline-none form-input dark:focus:shadow-outline-gray focus:shadow-outline-purple"
			placeholder="***************"
			type="password"
		/>
	</label>

	<!-- You should use a button here, as the anchor is only used for the example  -->
	<button
		type="submit"
		class="block py-2 px-4 mt-4 w-full text-sm font-medium leading-5 text-center text-white bg-purple-600 rounded-lg border border-transparent transition-colors duration-150 hover:bg-purple-700 focus:outline-none active:bg-purple-600 focus:shadow-outline-purple"
	>
		Log in
	</button>
</form>
