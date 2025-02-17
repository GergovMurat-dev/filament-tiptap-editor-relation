import { Mark, mergeAttributes } from '@tiptap/core'
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

// export const Relation = Link.extend({
//   name: 'relation',
//
//   addOptions() {
//     return {
//       ...this.parent?.(),
//       openOnClick: true,
//       linkOnPaste: false,
//       autolink: false,
//       protocols: [],
//       HTMLAttributes: {}
//     }
//   },
//
//   addAttributes() {
//     return {
//       model_id: {
//         default: null
//       },
//     }
//   },
//
//   parseHTML() {
//     return [
//       {
//         tag: 'relation'
//       }
//     ];
//   },
//
//   renderHTML({HTMLAttributes}) {
//     return ['relation', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), 0]
//   },
//
//   addComment() {
//     return {
//       setRelation: attributes => ({chain}) => {
//         console.log(attributes);
//
//         return chain().setMark(this.name, attributes).run();
//       }
//     }
//   }
// })