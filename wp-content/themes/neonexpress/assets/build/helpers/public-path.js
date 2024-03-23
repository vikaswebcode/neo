/* eslint-env browser */
/* globals NEONEXPRESS_DIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (NEONEXPRESS_DIST_PATH) {
  __webpack_public_path__ = NEONEXPRESS_DIST_PATH; // eslint-disable-line no-undef, camelcase
}
