import { Timeline, DataSet } from "vis-timeline/standalone";
window.drawTimeline = function drawTimeline(id, data) {
    let container = document.getElementById(id);
    let items = new DataSet(data);
    let options = {};
    new Timeline(container, items, options);
};
