function d(t) {
  return function (p) {
    const type = t;
    debugger;
    return p;
  }
}

const myPolicy = trustedTypes.createPolicy('default', {
  createHTML: d('createHTML'),
  createScriptURL: d('createScriptURL'),
  createScript: d('createScript'),
});