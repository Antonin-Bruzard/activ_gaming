<template>
    <div>
        <client-only>
            <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }" class="blog-edit">
                <div class="menubar">

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.bold() }"
                            @click.prevent="commands.bold"
                    >
                        <fa :icon="bold"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.italic() }"
                            @click.prevent="commands.italic"
                    >
                        <fa :icon="italic"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.strike() }"
                            @click.prevent="commands.strike"
                    >
                        <fa :icon="strike"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.underline() }"
                            @click.prevent="commands.underline"
                    >
                        <fa :icon="underline"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.code() }"
                            @click.prevent="commands.code"
                    >
                        <fa :icon="code"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.paragraph() }"
                            @click.prevent="commands.paragraph"
                    >
                        <fa :icon="paragraph"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                            @click.prevent="commands.heading({ level: 1 })"
                    >
                        H1
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                            @click.prevent="commands.heading({ level: 2 })"
                    >
                        H2
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                            @click.prevent="commands.heading({ level: 3 })"
                    >
                        H3
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.bullet_list() }"
                            @click.prevent="commands.bullet_list"
                    >
                        <fa :icon="listUl"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.ordered_list() }"
                            @click.prevent="commands.ordered_list"
                    >
                        <fa :icon="listOl"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.blockquote() }"
                            @click.prevent="commands.blockquote"
                    >
                        <fa :icon="quote"/>
                    </button>

                    <button
                            class="menubar__button"
                            :class="{ 'is-active': isActive.code_block() }"
                            @click.prevent="commands.code_block"
                    >
                        <fa :icon="code"/>
                    </button>

                    <button
                            class="menubar__button"
                            @click.prevent="commands.horizontal_rule"
                    >
                        <fa :icon="hr"/>
                    </button>

                    <button
                            class="menubar__button"
                            @click.prevent="commands.undo"
                    >
                        <fa :icon="undo"/>
                    </button>

                    <button
                            class="menubar__button"
                            @click.prevent="commands.redo"
                    >
                        <fa :icon="redo"/>
                    </button>

                </div>
            </editor-menu-bar>

            <editor-content class="editor__content" :editor="editor" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        </client-only>
    </div>
</template>

<script>
    import {Editor, EditorContent, EditorMenuBar} from 'tiptap'
    import {
        Blockquote,
        CodeBlock,
        HardBreak,
        Heading,
        HorizontalRule,
        OrderedList,
        BulletList,
        ListItem,
        TodoItem,
        TodoList,
        Bold,
        Code,
        Italic,
        Link,
        Strike,
        Underline,
        History,
    } from 'tiptap-extensions'
    import {
        faBold,
        faItalic,
        faUnderline,
        faStrikethrough,
        faCode,
        faParagraph,
        faListUl,
        faListOl,
        faQuoteRight,
        faWindowMinimize,
        faUndoAlt,
        faRedoAlt
    } from '@fortawesome/free-solid-svg-icons/index'

    export default {
        components: {
            EditorContent,
            EditorMenuBar,
            faBold,
            faItalic,
            faUnderline,
            faStrikethrough,
            faCode,
            faParagraph,
            faListUl,
            faListOl,
            faQuoteRight,
            faWindowMinimize,
            faUndoAlt,
            faRedoAlt,
        },

        data() {
            return {
                editor: '',
            }
        },

        methods: {
            emitToParent(event) {
                this.$emit('onChildClick', this.form.content)
            },
        },

        computed: {
            bold() {
                return faBold
            },
            italic() {
                return faItalic
            },
            underline() {
                return faUnderline
            },
            strike() {
                return faStrikethrough
            },
            code() {
                return faCode
            },
            paragraph() {
                return faParagraph
            },
            listUl() {
                return faListUl
            },
            listOl() {
                return faListOl
            },
            quote() {
                return faQuoteRight
            },
            hr() {
                return faWindowMinimize
            },
            undo() {
                return faUndoAlt
            },
            redo() {
                return faRedoAlt
            },
        },

        mounted() {
            this.editor = new Editor({
                extensions: [
                    new Blockquote(),
                    new BulletList(),
                    new CodeBlock(),
                    new HardBreak(),
                    new Heading({levels: [1, 2, 3]}),
                    new HorizontalRule(),
                    new ListItem(),
                    new OrderedList(),
                    new TodoItem(),
                    new TodoList(),
                    new Link(),
                    new Bold(),
                    new Code(),
                    new Italic(),
                    new Strike(),
                    new Underline(),
                    new History(),
                ],

                content: this.form.content,

                onUpdate: ({getHTML}) => {
                    const editorData = getHTML()
                    this.form.content = editorData
                    this.emitToParent()
                },

            })
        },

        beforeDestroy() {
            this.editor.destroy()
        },

        /**
         * Load props from parents.
         */
        props: {
            form: Object, required: true
        },
    }
</script>