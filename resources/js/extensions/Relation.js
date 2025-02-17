import { mergeAttributes } from '@tiptap/core'
import Link from '@tiptap/extension-link'

export const Relation = Link.extend({
  name: 'relation',

  addOptions() {
    return {
      ...this.parent?.(),
      protocols: [],
      HTMLAttributes: {
        target: null,
        model: null,
        id: null,
      },
    }
  },

  addAttributes() {
    return {
      target: {
        default: this.options.HTMLAttributes.target,
        parseHTML(element) {
          return element.getAttribute('target')
        }
      },
      model: {
        default: this.options.HTMLAttributes.model,
      },
      id: {
        default: this.options.HTMLAttributes.id,
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