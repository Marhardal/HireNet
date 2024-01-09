<template>
  <div class="mt-4 mx-auto max-w-2xl">
    <editor-content :editor="editor" />
  </div>
  <!-- <editor-content :editor="editor" /> -->
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

const editor = useEditor({
  content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
  extensions: [
    StarterKit,
  ],
})
</script>