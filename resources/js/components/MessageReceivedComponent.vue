<template>
	<div class="row received col-10">
		<div class="col-auto rounded">
			{{ content }}
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			content: String
		},
		mounted() {
			console.log('received message Component mounted.')
		}
	}
</script>