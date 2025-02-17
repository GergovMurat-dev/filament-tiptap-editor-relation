import { mergeAttributes } from '@tiptap/core'
import Link from '@tiptap/extension-link'

export const Relation = Link.extend({
  name: 'relation',

  addOptions() {
    return {
      ...this.parent?.(),
      protocols: [],
      HTMLAttributes: {},
    }
  },

  addAttributes() {
    return {
      target: {
        default: null,
      },
      model: {
        default: null,
      },
      id: {
        default: null,
      }
    }
  },

  parseHTML() {
    return [
      {
        tag: 'relation',
      },
    ]
  },

  renderHTML({ HTMLAttributes }) {
    return ['relation', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), 0]
  },

  addCommands() {
    return {
      setRelation: attributes => ({ chain }) => {
          return chain().setMark(this.name, attributes).run()
      },
    }
  },
})