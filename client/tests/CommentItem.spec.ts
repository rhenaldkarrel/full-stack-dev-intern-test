import { describe, it, expect } from "vitest";
import { mount } from "@vue/test-utils";

import CommentItem from "../components/CommentItem.vue";

describe("Comment Item", () => {
    it("is rendered properly", () => {
        const wrapper = mount(CommentItem, {
            props: {
                username: "John Doe",
                comment:
                    "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            },
        });
        expect(wrapper.vm).toBeTruthy();
    });
});
