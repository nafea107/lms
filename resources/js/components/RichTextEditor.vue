<template>
    <div class="rich-text-editor border rounded-md">
        <!-- Toolbar -->
        <div v-if="editor" class="toolbar border-b bg-gray-50 p-2 flex flex-wrap gap-1">
            <!-- Text Formatting -->
            <button
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'is-active': editor.isActive('bold') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-bold" />
            </button>
            <button
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'is-active': editor.isActive('italic') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-italic" />
            </button>
            <button
                @click="editor.chain().focus().toggleUnderline().run()"
                :class="{ 'is-active': editor.isActive('underline') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-underline" />
            </button>
            <button
                @click="editor.chain().focus().toggleStrike().run()"
                :class="{ 'is-active': editor.isActive('strike') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-strikethrough" />
            </button>

            <div class="border-l mx-1"></div>

            <!-- Headings -->
            <button
                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
                class="toolbar-btn"
                type="button"
            >
                H1
            </button>
            <button
                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
                class="toolbar-btn"
                type="button"
            >
                H2
            </button>
            <button
                @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
                class="toolbar-btn"
                type="button"
            >
                H3
            </button>

            <div class="border-l mx-1"></div>

            <!-- Lists -->
            <button
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editor.isActive('bulletList') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-list-bulleted" />
            </button>
            <button
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'is-active': editor.isActive('orderedList') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-list-numbered" />
            </button>

            <div class="border-l mx-1"></div>

            <!-- Alignment -->
            <button
                @click="editor.chain().focus().setTextAlign('left').run()"
                :class="{ 'is-active': editor.isActive({ textAlign: 'left' }) }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-align-left" />
            </button>
            <button
                @click="editor.chain().focus().setTextAlign('center').run()"
                :class="{ 'is-active': editor.isActive({ textAlign: 'center' }) }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-align-center" />
            </button>
            <button
                @click="editor.chain().focus().setTextAlign('right').run()"
                :class="{ 'is-active': editor.isActive({ textAlign: 'right' }) }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-align-right" />
            </button>

            <div class="border-l mx-1"></div>

            <!-- Quote and Code -->
            <button
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'is-active': editor.isActive('blockquote') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:format-quote-close" />
            </button>
            <button
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'is-active': editor.isActive('codeBlock') }"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:code-tags" />
            </button>

            <div class="border-l mx-1"></div>

            <!-- Image and Link -->
            <button
                @click="triggerImageUpload"
                class="toolbar-btn"
                type="button"
                title="Upload Image"
            >
                <Icon icon="mdi:image" />
            </button>
            <input
                ref="imageInput"
                type="file"
                accept="image/*"
                @change="handleImageUpload"
                class="hidden"
            />
            <button
                @click="addLink"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:link" />
            </button>

            <div class="border-l mx-1"></div>

            <!-- Undo/Redo -->
            <button
                @click="editor.chain().focus().undo().run()"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:undo" />
            </button>
            <button
                @click="editor.chain().focus().redo().run()"
                class="toolbar-btn"
                type="button"
            >
                <Icon icon="mdi:redo" />
            </button>
        </div>

        <!-- Editor Content -->
        <EditorContent :editor="editor" class="editor-content p-4 min-h-[200px]" />
    </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import TextAlign from '@tiptap/extension-text-align';
import Underline from '@tiptap/extension-underline';
import { Icon } from '@iconify/vue';
import { watch, onBeforeUnmount, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['update:modelValue']);

const imageInput = ref(null);

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        Underline,
        Image.configure({
            inline: true,
            allowBase64: true,
        }),
        Link.configure({
            openOnClick: false,
            HTMLAttributes: {
                target: '_blank',
                rel: 'noopener noreferrer',
            },
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
    ],
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    },
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-xl focus:outline-none max-w-none',
        },
    },
});

// Watch for external changes to modelValue
watch(() => props.modelValue, (value) => {
    const isSame = editor.value.getHTML() === value;
    if (!isSame) {
        editor.value.commands.setContent(value, false);
    }
});

function triggerImageUpload() {
    imageInput.value?.click();
}

function handleImageUpload(event) {
    const file = event.target.files?.[0];
    if (!file) return;

    // Check if file is an image
    if (!file.type.startsWith('image/')) {
        alert('Please select an image file');
        return;
    }

    // Convert image to base64
    const reader = new FileReader();
    reader.onload = (e) => {
        const base64Image = e.target.result;
        editor.value.chain().focus().setImage({ src: base64Image }).run();
    };
    reader.readAsDataURL(file);

    // Reset input
    event.target.value = '';
}

function addLink() {
    const url = window.prompt('Enter URL:');
    if (url) {
        editor.value.chain().focus().setLink({ href: url }).run();
    }
}

onBeforeUnmount(() => {
    if (editor.value) {
        editor.value.destroy();
    }
});
</script>

<style scoped>
.toolbar-btn {
    @apply p-2 rounded hover:bg-gray-200 transition-colors duration-200;
    min-width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toolbar-btn.is-active {
    @apply bg-gray-300;
}

.editor-content :deep(.ProseMirror) {
    min-height: 200px;
    outline: none;
}

.editor-content :deep(.ProseMirror p) {
    margin: 0.5rem 0;
}

.editor-content :deep(.ProseMirror h1) {
    font-size: 2rem;
    font-weight: bold;
    margin: 1rem 0;
}

.editor-content :deep(.ProseMirror h2) {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0.875rem 0;
}

.editor-content :deep(.ProseMirror h3) {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0.75rem 0;
}

.editor-content :deep(.ProseMirror ul),
.editor-content :deep(.ProseMirror ol) {
    padding-right: 1.5rem;
    margin: 0.5rem 0;
}

.editor-content :deep(.ProseMirror blockquote) {
    border-right: 3px solid #e5e7eb;
    padding-right: 1rem;
    margin: 1rem 0;
    color: #6b7280;
}

.editor-content :deep(.ProseMirror code) {
    background-color: #f3f4f6;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-family: monospace;
}

.editor-content :deep(.ProseMirror pre) {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1rem 0;
}

.editor-content :deep(.ProseMirror pre code) {
    background-color: transparent;
    color: inherit;
    padding: 0;
}

.editor-content :deep(.ProseMirror img) {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1rem 0;
}

.editor-content :deep(.ProseMirror a) {
    color: #2563eb;
    text-decoration: underline;
}
</style>
