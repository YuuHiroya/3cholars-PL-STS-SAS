/**
 * SCHOLARSHIP UTILITIES
 *
 * Functions for managing saved scholarships with localStorage persistence
 * localStorage key: "user_savedScholarships"
 *
 * ASSUMPTIONS:
 * - User data persists in localStorage for this session
 * - Backend integration ready via saveScholarshipToProfile() hook
 * - Each saved scholarship includes: id, title, university, logoUrl, rank, acceptanceRate, savedAt
 * - Timestamp format: ISO 8601
 */

const STORAGE_KEY = "user_savedScholarships";

/**
 * Get all saved scholarships from localStorage
 * @returns {Array} Array of saved scholarship objects
 */
export function getSavedScholarships() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY);
        return stored ? JSON.parse(stored) : [];
    } catch (error) {
        console.error(
            "Error reading saved scholarships from localStorage:",
            error
        );
        return [];
    }
}

/**
 * Check if a scholarship is saved
 * @param {string} scholarshipId - The scholarship ID
 * @returns {boolean} True if scholarship is saved
 */
export function isScholarshipSaved(scholarshipId) {
    const saved = getSavedScholarships();
    return saved.some((sch) => sch.id === scholarshipId);
}

/**
 * Add a scholarship to saved list
 * @param {Object} scholarship - Scholarship object with at least: id, title, university, logoUrl, rank, acceptanceRate
 * @returns {boolean} True if successfully added
 */
export function saveScholarship(scholarship) {
    try {
        const saved = getSavedScholarships();

        // Prevent duplicates
        if (saved.some((sch) => sch.id === scholarship.id)) {
            console.warn(`Scholarship ${scholarship.id} is already saved`);
            return false;
        }

        const savedEntry = {
            id: scholarship.id,
            title: scholarship.title,
            university: scholarship.university,
            logoUrl: scholarship.logoUrl,
            rank: scholarship.rank,
            acceptanceRate: scholarship.acceptanceRate,
            deadline: scholarship.deadline,
            tags: scholarship.tags,
            savedAt: new Date().toISOString(),
        };

        saved.push(savedEntry);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(saved));
        console.log(`Scholarship saved: ${scholarship.id}`);

        // Hook for future backend integration
        saveScholarshipToProfile(scholarship.id, savedEntry);

        return true;
    } catch (error) {
        console.error("Error saving scholarship:", error);
        return false;
    }
}

/**
 * Remove a scholarship from saved list
 * @param {string} scholarshipId - The scholarship ID
 * @returns {boolean} True if successfully removed
 */
export function removeScholarship(scholarshipId) {
    try {
        const saved = getSavedScholarships();
        const filtered = saved.filter((sch) => sch.id !== scholarshipId);

        if (filtered.length === saved.length) {
            console.warn(
                `Scholarship ${scholarshipId} was not in saved list`
            );
            return false;
        }

        localStorage.setItem(STORAGE_KEY, JSON.stringify(filtered));
        console.log(`Scholarship removed: ${scholarshipId}`);

        // Hook for future backend integration
        removeScholarshipFromProfile(scholarshipId);

        return true;
    } catch (error) {
        console.error("Error removing scholarship:", error);
        return false;
    }
}

/**
 * Toggle save state of a scholarship
 * @param {Object} scholarship - Scholarship object
 * @returns {Object} { isSaved: boolean, saved: number, removed: number }
 */
export function toggleSaveScholarship(scholarship) {
    const isSaved = isScholarshipSaved(scholarship.id);

    if (isSaved) {
        const success = removeScholarship(scholarship.id);
        return {
            isSaved: false,
            action: "removed",
            success,
        };
    } else {
        const success = saveScholarship(scholarship);
        return {
            isSaved: true,
            action: "saved",
            success,
        };
    }
}

/**
 * Clear all saved scholarships (for debugging/testing)
 */
export function clearAllSavedScholarships() {
    localStorage.removeItem(STORAGE_KEY);
    console.log("All saved scholarships cleared");
}

/**
 * Get saved scholarships count
 * @returns {number} Number of saved scholarships
 */
export function getSavedCount() {
    return getSavedScholarships().length;
}

/**
 * BACKEND INTEGRATION HOOKS
 * These functions are called after localStorage update
 * Implement these to sync with your backend
 */

/**
 * Hook: Save scholarship to user profile on backend
 * @param {string} scholarshipId - The scholarship ID
 * @param {Object} savedEntry - The saved scholarship entry
 *
 * IMPLEMENTATION EXAMPLE (when backend is ready):
 * export async function saveScholarshipToProfile(scholarshipId, savedEntry) {
 *   try {
 *     const response = await fetch('/api/user/scholarships/save', {
 *       method: 'POST',
 *       headers: { 'Content-Type': 'application/json' },
 *       body: JSON.stringify({ scholarshipId, savedEntry })
 *     });
 *     if (!response.ok) throw new Error('Failed to save');
 *     console.log('✅ Saved to backend:', scholarshipId);
 *   } catch (error) {
 *     console.error('❌ Backend save failed:', error);
 *   }
 * }
 */
export function saveScholarshipToProfile(scholarshipId, savedEntry) {
    console.log("[BACKEND HOOK] saveScholarshipToProfile:", scholarshipId);
    // Placeholder - implement when backend is ready
}

/**
 * Hook: Remove scholarship from user profile on backend
 * @param {string} scholarshipId - The scholarship ID
 */
export function removeScholarshipFromProfile(scholarshipId) {
    console.log(
        "[BACKEND HOOK] removeScholarshipFromProfile:",
        scholarshipId
    );
    // Placeholder - implement when backend is ready
}

/**
 * Initialize saved scholarships from backend (future)
 * Call this on app startup to sync from server
 *
 * IMPLEMENTATION EXAMPLE (when backend is ready):
 * export async function initSavedScholarshipsFromBackend(userId) {
 *   try {
 *     const response = await fetch(`/api/user/${userId}/scholarships/saved`);
 *     const data = await response.json();
 *     localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
 *     console.log('✅ Synced from backend:', data.length, 'scholarships');
 *   } catch (error) {
 *     console.error('❌ Backend sync failed:', error);
 *   }
 * }
 */
export function initSavedScholarshipsFromBackend(userId) {
    console.log(
        "[BACKEND HOOK] initSavedScholarshipsFromBackend for user:",
        userId
    );
    // Placeholder - implement when backend is ready
}
