import {mergeAttributes} from '@tiptap/core';
import Link from "@tiptap/extension-link";

export const Relation = Link.extend({
  name: 'relation',

  addOptions() {
    return {
      ...this.parent?.(),
      openOnClick: true,
      linkOnPaste: false,
      autolink: false,
      protocols: [],
      HTMLAttributes: {}
    }
  },

  addAttributes() {
    return {
      model_id: {
        default: null
      },
    }
  },

  parseHTML() {
    return [
      {
        tag: 'relation'
      }
    ];
  },

  renderHTML({HTMLAttributes}) {
    return ['relation', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), 0]
  },
})